import React from 'react';
import { Box, Typography, TextField, Button, Avatar } from '@mui/material';

export default function ProfileSection() {
  return (
    <Box>
      <Typography variant="h4" gutterBottom>Profile Settings</Typography>
      <Box sx={{ display: 'flex', gap: 4 }}>
        <Box sx={{ width: 200 }}>
          <Avatar sx={{ width: 120, height: 120, mb: 2 }} />
          <Button variant="contained" fullWidth>
            Upload Photo
          </Button>
        </Box>
        <Box sx={{ flexGrow: 1 }}>
          <TextField
            label="Full Name"
            fullWidth
            margin="normal"
          />
          <TextField
            label="Email"
            fullWidth
            margin="normal"
          />
          <TextField
            label="Phone Number"
            fullWidth
            margin="normal"
          />
          <Button variant="contained" sx={{ mt: 2 }}>
            Save Changes
          </Button>
        </Box>
      </Box>
    </Box>
  );
}
