import { useState, useEffect } from 'react';
import { 
  Container, 
  Typography, 
  TextField, 
  Button, 
  Grid, 
  Paper, 
  List, 
  ListItem, 
  ListItemText, 
  Divider
} from '@mui/material';
import { useWeb3 } from '../context/Web3Context';

const KindnessPage = () => {
  const { account, sendKindness } = useWeb3();
  const [receiver, setReceiver] = useState('');
  const [amount, setAmount] = useState('');
  const [message, setMessage] = useState('');
  const [balance] = useState(0);
  const [transactions, setTransactions] = useState([]);

  useEffect(() => {
    if (account) {
      // Future: Add any account-specific initialization here
    }
  }, [account]);

  const handleSendKindness = async () => {
    if (!receiver || !amount || !message) return;
    
    try {
      const tx = await sendKindness(receiver, amount, message);
      setTransactions(prev => [{
        receiver,
        amount,
        message,
        timestamp: new Date().toLocaleString(),
        txHash: tx.transactionHash
      }, ...prev]);
      
      // Clear form
      setReceiver('');
      setAmount('');
      setMessage('');
    } catch (error) {
      console.error('Error sending kindness:', error);
    }
  };

  return (
    <Container maxWidth="md" sx={{ mt: 4 }}>
      <Grid container spacing={4}>
        <Grid item xs={12} md={6}>
          <Paper sx={{ p: 3 }}>
            <Typography variant="h5" gutterBottom>
              Send Kindness
            </Typography>
            
            <TextField
              fullWidth
              label="Receiver Address"
              value={receiver}
              onChange={(e) => setReceiver(e.target.value)}
              margin="normal"
            />
            
            <TextField
              fullWidth
              label="Amount"
              type="number"
              value={amount}
              onChange={(e) => setAmount(e.target.value)}
              margin="normal"
            />
            
            <TextField
              fullWidth
              label="Message"
              multiline
              rows={4}
              value={message}
              onChange={(e) => setMessage(e.target.value)}
              margin="normal"
            />
            
            <Button
              fullWidth
              variant="contained"
              onClick={handleSendKindness}
              disabled={!account}
              sx={{ mt: 2 }}
            >
              Send Kindness
            </Button>
          </Paper>
        </Grid>
        
        <Grid item xs={12} md={6}>
          <Paper sx={{ p: 3 }}>
            <Typography variant="h5" gutterBottom>
              Your Kindness Balance
            </Typography>
            <Typography variant="h3" color="primary">
              {balance} KND
            </Typography>
            
            <Divider sx={{ my: 3 }} />
            
            <Typography variant="h6" gutterBottom>
              Recent Transactions
            </Typography>
            
            <List>
              {transactions.map((tx, index) => (
                <div key={index}>
                  <ListItem>
                    <ListItemText
                      primary={`To: ${tx.receiver.slice(0, 6)}...${tx.receiver.slice(-4)}`}
                      secondary={`${tx.amount} KND - ${tx.timestamp}`}
                    />
                    <Typography variant="body2" color="text.secondary">
                      {tx.message}
                    </Typography>
                  </ListItem>
                  {index < transactions.length - 1 && <Divider />}
                </div>
              ))}
            </List>
          </Paper>
        </Grid>
      </Grid>
    </Container>
  );
};

export default KindnessPage;
