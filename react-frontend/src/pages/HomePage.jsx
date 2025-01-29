import { Container, Typography, Button, Grid, Paper, Box } from '@mui/material';
import { useWeb3 } from '../context/Web3Context';
import { Link } from 'react-router-dom';

const HomePage = () => {
  const { account } = useWeb3();

  return (
    <Container maxWidth="lg">
      <Box sx={{ my: 4, textAlign: 'center' }}>
        <Typography variant="h2" component="h1" gutterBottom>
          Welcome to PayingItForward
        </Typography>
        <Typography variant="h5" color="text.secondary" paragraph>
          A blockchain-powered platform for spreading kindness
        </Typography>
        
        <Box sx={{ mt: 4, mb: 6 }}>
          {account ? (
            <Button
              variant="contained"
              size="large"
              component={Link}
              to="/kindness"
              sx={{ mr: 2 }}
            >
              Send Kindness
            </Button>
          ) : (
            <Typography variant="body1" color="text.secondary">
              Connect your wallet to start spreading kindness
            </Typography>
          )}
          <Button
            variant="outlined"
            size="large"
            component={Link}
            to="/community"
            sx={{ ml: 2 }}
          >
            Explore Community
          </Button>
        </Box>

        <Grid container spacing={4}>
          <Grid item xs={12} md={4}>
            <Paper sx={{ p: 3, height: '100%' }}>
              <Typography variant="h4" color="primary" gutterBottom>
                1,234
              </Typography>
              <Typography variant="h6">
                Acts of Kindness
              </Typography>
              <Typography variant="body2" color="text.secondary">
                Performed on our platform
              </Typography>
            </Paper>
          </Grid>
          
          <Grid item xs={12} md={4}>
            <Paper sx={{ p: 3, height: '100%' }}>
              <Typography variant="h4" color="primary" gutterBottom>
                5,678
              </Typography>
              <Typography variant="h6">
                Tokens Circulated
              </Typography>
              <Typography variant="body2" color="text.secondary">
                Representing acts of kindness
              </Typography>
            </Paper>
          </Grid>
          
          <Grid item xs={12} md={4}>
            <Paper sx={{ p: 3, height: '100%' }}>
              <Typography variant="h4" color="primary" gutterBottom>
                987
              </Typography>
              <Typography variant="h6">
                Active Users
              </Typography>
              <Typography variant="body2" color="text.secondary">
                Spreading kindness daily
              </Typography>
            </Paper>
          </Grid>
        </Grid>
      </Box>
    </Container>
  );
};

export default HomePage;
