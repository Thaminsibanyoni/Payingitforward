import { createContext, useContext, useEffect, useState } from 'react';
import PropTypes from 'prop-types';
import Web3 from 'web3';
import PayItForwardToken from '../contracts/PayItForwardToken.json';


const Web3Context = createContext();

export const Web3Provider = ({ children }) => {
  // Validate the children prop and any other props
  Web3Provider.propTypes = {
    children: PropTypes.node.isRequired, // children is required for context providers
  };

  const [web3, setWeb3] = useState(null);
  const [account, setAccount] = useState(null);
  const [contract, setContract] = useState(null);
  const [networkId, setNetworkId] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const initWeb3 = async () => {
      if (window.ethereum) {
        try {
          const web3Instance = new Web3(window.ethereum);
          await window.ethereum.enable();

          const accounts = await web3Instance.eth.getAccounts();
          const networkId = await web3Instance.eth.net.getId();

          const deployedNetwork = PayItForwardToken.networks[networkId];
          const instance = new web3Instance.eth.Contract(
            PayItForwardToken.abi,
            deployedNetwork && deployedNetwork.address
          );

          setWeb3(web3Instance);
          setAccount(accounts[0]);
          setContract(instance);
          setNetworkId(networkId);
          setLoading(false);

          window.ethereum.on('accountsChanged', (accounts) => {
            setAccount(accounts[0]);
          });

          window.ethereum.on('chainChanged', () => {
            window.location.reload();
          });

        } catch (error) {
          console.error('Error initializing Web3:', error);
        }
      } else {
        console.log('Please install MetaMask!');
      }
    };

    initWeb3();
  }, []);

  const sendKindness = async (receiver, amount, message) => {
    if (!contract || !account) return;

    try {
      const tx = await contract.methods.transfer(receiver, amount)
        .send({ from: account });

      // Store kindness act in backend
      await fetch('/api/kindness', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          sender: account,
          receiver,
          amount,
          message,
          txHash: tx.transactionHash
        })
      });

      return tx;
    } catch (error) {
      console.error('Error sending kindness:', error);
      throw error;
    }
  };

  return (
    <Web3Context.Provider
      value={{
        web3,
        account,
        contract,
        networkId,
        loading,
        sendKindness
      }}
    >
      {children}
    </Web3Context.Provider>
  );
};

// Adding PropTypes validation for the Web3Provider component
Web3Provider.propTypes = {
  children: PropTypes.node.isRequired,
};

export const useWeb3 = () => useContext(Web3Context);
