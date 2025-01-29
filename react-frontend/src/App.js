import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import ActsList from './components/ActsList';
import { ThemeProvider, createTheme } from '@mui/material/styles';
import CssBaseline from '@mui/material/CssBaseline';
import Container from '@mui/material/Container';
import HomePage from './pages/HomePage';
import NewLoginPage from './pages/NewLoginPage';
import RegisterPage from './pages/RegisterPage';
import ProfilePage from './pages/ProfilePage';
import CommunityPage from './pages/CommunityPage';
import DashboardPage from './pages/DashboardPage';
import NavBar from './components/NavBar';
import { Web3Provider } from './context/Web3Context';

const theme = createTheme({
  palette: {
    primary: {
      main: '#6C9BCF',
      light: '#A8C8F0',
      dark: '#3E6BA8',
    },
    secondary: {
      main: '#83C5BE',
      light: '#B4E0DB',
      dark: '#5A9E96',
    },
    background: {
      default: '#F8F9FA',
      paper: '#FFFFFF',
    },
    text: {
      primary: '#2D3436',
      secondary: '#636E72',
    },
  },
  typography: {
    fontFamily: [
      'Inter',
      '-apple-system',
      'BlinkMacSystemFont',
      '"Segoe UI"',
      'Roboto',
      '"Helvetica Neue"',
      'Arial',
      'sans-serif',
    ].join(','),
    h1: {
      fontWeight: 700,
      fontSize: '2.5rem',
    },
    button: {
      textTransform: 'none',
    },
  },
  shape: {
    borderRadius: 12,
  },
});

function App() {
  return (
    <Web3Provider>
      <ThemeProvider theme={theme}>
        <CssBaseline />
        <Router>
          <NavBar />
          <Container maxWidth="xl" sx={{ 
            pt: 4,
            minHeight: 'calc(100vh - 64px)',
            display: 'flex',
            flexDirection: 'column'
          }}>
            <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/login" element={<NewLoginPage />} />
            <Route path="/register" element={<RegisterPage />} />
            <Route path="/kindness" element={<ActsList />} />
            <Route path="/profile" element={<ProfilePage />} />
            <Route path="/community" element={<CommunityPage />} />
            <Route path="/dashboard" element={<DashboardPage />} />
          </Routes>
          </Container>
        </Router>
      </ThemeProvider>
    </Web3Provider>
  );
}

export default App;
