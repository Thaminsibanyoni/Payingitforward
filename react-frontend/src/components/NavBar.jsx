import { AppBar, Toolbar, Typography, Button, Box, Chip } from '@mui/material';
import { Link } from 'react-router-dom';
import { useWeb3 } from '../context/Web3Context';

const NavBar = () => {
  const { account, loading, networkId } = useWeb3();

  return (
    <AppBar position="static">
      <Toolbar>
        <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
          Pay It Forward
        </Typography>
        
        <Box sx={{ display: 'flex', gap: 2, alignItems: 'center' }}>
          <Button color="inherit" component={Link} to="/">
            Home
          </Button>
          <Button color="inherit" component={Link} to="/kindness">
            Kindness
          </Button>
          <Button color="inherit" component={Link} to="/community">
            Community
          </Button>
          
          {account ? (
            <Chip
              label={`${account.slice(0, 6)}...${account.slice(-4)}`}
              color="secondary"
              variant="outlined"
            />
          ) : (
            <Button 
              color="secondary" 
              variant="contained"
              disabled={loading}
            >
              {loading ? 'Connecting...' : 'Connect Wallet'}
            </Button>
          )}
          
          <Chip
            label={`Network: ${networkId || 'Unknown'}`}
            color="info"
            variant="outlined"
          />
        </Box>
      </Toolbar>
    </AppBar>
  );
};

export default NavBar;
