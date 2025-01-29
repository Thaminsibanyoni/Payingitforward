import React, { useState } from 'react';
import PropTypes from 'prop-types';
import { Box, Tabs, Tab, Typography, Container, Paper } from '@mui/material';
import ProfileSection from '../components/dashboard/ProfileSection';
import WalletSection from '../components/dashboard/WalletSection';

function TabPanel(props) {
  const { children, value, index, ...other } = props;
  return (
    <div role="tabpanel" hidden={value !== index} {...other}>
      {value === index && (
        <Box sx={{ p: 3 }}>
          <Typography>{children}</Typography>
        </Box>
      )}
    </div>
  );
}

TabPanel.propTypes = {
  children: PropTypes.node,
  value: PropTypes.number.isRequired,
  index: PropTypes.number.isRequired,
};

export default function DashboardPage() {
  const [tabValue, setTabValue] = useState(0);

  const handleTabChange = (event, newValue) => {
    setTabValue(newValue);
  };

  return (
    <Container maxWidth="xl">
      <Paper elevation={3} sx={{ mt: 4, p: 2 }}>
        <Tabs value={tabValue} onChange={handleTabChange} variant="scrollable">
          <Tab label="Profile" />
          <Tab label="Wallet" />
          <Tab label="Notifications" />
          <Tab label="Settings" />
        </Tabs>
        
        <TabPanel value={tabValue} index={0}>
          <ProfileSection />
        </TabPanel>
        <TabPanel value={tabValue} index={1}>
          <WalletSection />
        </TabPanel>
      </Paper>
    </Container>
  );
}
