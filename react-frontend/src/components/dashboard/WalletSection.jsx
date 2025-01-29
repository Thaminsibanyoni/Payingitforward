import React from 'react';
import { Box, Typography, Button, Paper, Stack, Divider, Chip } from '@mui/material';
import AccountBalanceWalletIcon from '@mui/icons-material/AccountBalanceWallet';
import AddIcon from '@mui/icons-material/Add';
import { useWeb3 } from '../../context/Web3Context'; // ✅ FIXED: Import useWeb3

export default function WalletSection() {
  const { walletAddress } = useWeb3(); // ✅ Now useWeb3 is properly imported

  return (
    <Box>
      <Typography variant="h4" gutterBottom>Wallet Management</Typography>
      
      <Paper elevation={0} sx={{ p: 3, mb: 3, bgcolor: 'background.paper' }}>
        <Stack direction="row" spacing={2} alignItems="center">
          <AccountBalanceWalletIcon fontSize="large" />
          <Typography variant="h5">Current Balance: $0.00</Typography>
          <Button variant="contained" startIcon={<AddIcon />} sx={{ ml: 'auto' }}>
            Add Funds
          </Button>
        </Stack>
      </Paper>

      <Divider sx={{ my: 4 }}><Chip label="Payment Methods" /></Divider>

      <Box sx={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(300px, 1fr))', gap: 3 }}>
        <Paper sx={{ p: 3 }}>
          <Typography variant="h6" gutterBottom>Paystack</Typography>
          <Button variant="outlined" fullWidth>Connect Paystack</Button>
        </Paper>

        <Paper sx={{ p: 3 }}>
          <Typography variant="h6" gutterBottom>PayPal</Typography>
          <Button variant="outlined" fullWidth>Connect PayPal</Button>
        </Paper>

        <Paper sx={{ p: 3 }}>
          <Typography variant="h6" gutterBottom>Crypto Wallet</Typography>
          <Typography variant="body2" color="text.secondary" gutterBottom>
            {walletAddress || "Not connected"}
          </Typography>
          <Button 
            variant="outlined" 
            fullWidth
            disabled={!!walletAddress}
          >
            {walletAddress ? 'Connected' : 'Connect Web3 Wallet'}
          </Button>
        </Paper>
      </Box>
    </Box>
  );
}
