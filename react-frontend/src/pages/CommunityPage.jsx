import React from 'react';
import { Box, Typography, Paper, List, ListItem, ListItemText, Divider } from '@mui/material';

const CommunityPage = () => {
  return (
    <Box sx={{ p: 4 }}>
      <Typography variant="h4" gutterBottom>
        Paying It Forward: A Chain Reaction of Kindness
      </Typography>
      <Typography variant="body1" paragraph>
        PayingItForward is a concept that encourages individuals to perform acts of kindness or goodwill without expecting anything in return.
        The idea is that the recipient will "pay it forward" by helping someone else in the future. It is a chain reaction of kindness, where each act inspires others to do the same, creating a ripple effect of positivity and support.
      </Typography>

      <Paper elevation={3} sx={{ p: 3, mb: 3 }}>
        <Typography variant="h5" gutterBottom>Key Characteristics of Paying It Forward</Typography>
        <List>
          <ListItem>
            <ListItemText
              primary="Selflessness"
              secondary="Acts of generosity are done purely out of goodwill, without expecting rewards or recognition."
            />
          </ListItem>
          <ListItem>
            <ListItemText
              primary="Inspiration"
              secondary="Encourages recipients to continue the chain by helping others."
            />
          </ListItem>
          <ListItem>
            <ListItemText
              primary="Small or Big Acts"
              secondary="Can range from small gestures, like buying someone a coffee, to larger actions, like mentoring or supporting someone in need."
            />
          </ListItem>
          <ListItem>
            <ListItemText
              primary="Universal Application"
              secondary="It can occur in personal, professional, or community settings."
            />
          </ListItem>
        </List>
      </Paper>

      <Divider sx={{ my: 4 }} />

      <Paper elevation={3} sx={{ p: 3, mb: 3 }}>
        <Typography variant="h5" gutterBottom>Examples of Paying It Forward</Typography>
        <List>
          <ListItem>
            <ListItemText
              primary="Personal Acts"
              secondary="Covering a stranger's bill at a coffee shop or helping someone carry groceries."
            />
          </ListItem>
          <ListItem>
            <ListItemText
              primary="Community Service"
              secondary="Volunteering time or resources to help a local organization or family."
            />
          </ListItem>
          <ListItem>
            <ListItemText
              primary="Workplace Support"
              secondary="Assisting a colleague without expecting acknowledgment or repayment."
            />
          </ListItem>
          <ListItem>
            <ListItemText
              primary="Online Contributions"
              secondary="Sharing valuable knowledge, creating resources, or donating to crowdfunding campaigns."
            />
          </ListItem>
        </List>
      </Paper>

      <Divider sx={{ my: 4 }} />

      <Paper elevation={3} sx={{ p: 3 }}>
        <Typography variant="h5" gutterBottom>Benefits of Paying It Forward</Typography>
        <List>
          <ListItem>
            <ListItemText
              primary="Fosters Kindness and Gratitude"
              secondary="Encourages a culture of empathy and thankfulness."
            />
          </ListItem>
          <ListItem>
            <ListItemText
              primary="Builds Stronger Communities"
              secondary="Creates bonds between people and strengthens relationships."
            />
          </ListItem>
          <ListItem>
            <ListItemText
              primary="Promotes Mental Well-Being"
              secondary="Acts of kindness boost mood and overall happiness for both the giver and the receiver."
            />
          </ListItem>
          <ListItem>
            <ListItemText
              primary="Inspires a Chain Reaction"
              secondary="Motivates others to spread kindness, creating a larger positive impact."
            />
          </ListItem>
        </List>
      </Paper>
    </Box>
  );
};

export default CommunityPage;
