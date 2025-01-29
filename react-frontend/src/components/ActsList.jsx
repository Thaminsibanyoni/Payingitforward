import React, { useEffect, useState } from 'react';
import { getActs, createAct, completeAct, payForwardAct, logActOnChain } from '../services/api';

const ActsList = () => {
  const [acts, setActs] = useState([]);
  const [newAct, setNewAct] = useState({
    title: '',
    description: ''
  });

  useEffect(() => {
    fetchActs();
  }, []);

  const fetchActs = async () => {
    try {
      const actsData = await getActs();
      setActs(actsData);
    } catch (error) {
      console.error('Failed to fetch acts:', error);
    }
  };

  const handleCreateAct = async (e) => {
    e.preventDefault();
    try {
      await createAct(newAct);
      setNewAct({ title: '', description: '' });
      fetchActs();
    } catch (error) {
      console.error('Failed to create act:', error);
    }
  };

  const handleCompleteAct = async (actId) => {
    try {
      // First complete the act normally
      await completeAct(actId);
      
      // Then log the act on the blockchain
      const blockchainResponse = await logActOnChain(actId);
      console.log('Blockchain transaction:', blockchainResponse);
      
      fetchActs();
    } catch (error) {
      console.error('Failed to complete act:', error);
    }
  };

  const handlePayForward = async (actId) => {
    try {
      await payForwardAct(actId);
      fetchActs();
    } catch (error) {
      console.error('Failed to pay forward act:', error);
    }
  };

  return (
    <div>
      <h2>Acts of Kindness</h2>
      
      <form onSubmit={handleCreateAct}>
        <input
          type="text"
          placeholder="Title"
          value={newAct.title}
          onChange={(e) => setNewAct({...newAct, title: e.target.value})}
        />
        <textarea
          placeholder="Description"
          value={newAct.description}
          onChange={(e) => setNewAct({...newAct, description: e.target.value})}
        />
        <button type="submit">Create Act</button>
      </form>

      <div>
        {acts.map(act => (
          <div key={act.id} style={{border: '1px solid #ccc', padding: '10px', margin: '10px 0'}}>
            <h3>{act.title}</h3>
            <p>{act.description}</p>
            <p>Status: {act.status}</p>
            <button onClick={() => handleCompleteAct(act.id)}>Complete</button>
            <button onClick={() => handlePayForward(act.id)}>Pay Forward</button>
          </div>
        ))}
      </div>
    </div>
  );
};

export default ActsList;
