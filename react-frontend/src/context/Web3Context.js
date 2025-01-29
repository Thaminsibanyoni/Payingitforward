import React, { createContext, useContext, useEffect, useState } from 'react';
import Web3 from 'web3';
import PropTypes from 'prop-types';

const Web3Context = createContext();

export const Web3Provider = ({ children }) => {
  const [web3, setWeb3] = useState(null);
  const [walletAddress, setWalletAddress] = useState(null);
  const [networkId, setNetworkId] = useState(null);

  useEffect(() => {
    const initWeb3 = async () => {
      if (typeof window !== 'undefined' && window.ethereum) {
        const web3Instance = new Web3(window.ethereum);
        setWeb3(web3Instance);

        try {
          const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
          setWalletAddress(accounts[0] || null);

          const network = await web3Instance.eth.net.getId();
          setNetworkId(network);
        } catch (error) {
          console.error('User denied account access', error);
        }

        // Event listeners for account and network changes
        window.ethereum.on('accountsChanged', (accounts) => {
          setWalletAddress(accounts[0] || null);
        });

        window.ethereum.on('chainChanged', async () => {
          const newNetworkId = await web3Instance.eth.net.getId();
          setNetworkId(newNetworkId);
        });
      } else {
        console.warn('Non-Ethereum browser detected. Consider using MetaMask!');
      }
    };

    initWeb3();

    return () => {
      if (window.ethereum) {
        window.ethereum.removeListener('accountsChanged', setWalletAddress);
        window.ethereum.removeListener('chainChanged', setNetworkId);
      }
    };
  }, []);

  return (
    <Web3Context.Provider value={{ web3, walletAddress, networkId }}>
      {children}
    </Web3Context.Provider>
  );
};

Web3Provider.propTypes = {
  children: PropTypes.node.isRequired,
};

export const useWeb3 = () => {
  return useContext(Web3Context);
};

Web3Context.displayName = 'Web3Context';
