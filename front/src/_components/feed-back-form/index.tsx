import React, { useState } from 'react';
import {
  Box,
  Button,
  TextField,
  Typography,
  Paper,
  Stack,
} from '@mui/material';

interface FeedbackData {
  firstName: string;
  lastName: string;
  email: string;
  comment: string;
}

const FeedbackForm: React.FC = () => {
  const [formData, setFormData] = useState<FeedbackData>({
    firstName: '',
    lastName: '',
    email: '',
    comment: '',
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value,
    }));
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    console.log('Feedback envoyé :', formData);
    // TODO: send to backend (API POST)
  };

  return (
    <Paper
      elevation={4}
      sx={{
        maxWidth: 600,
        margin: 'auto',
        mt: 5,
        p: 4,
        borderRadius: 3,
        backgroundColor: '#fff',
      }}
    >
      <Typography variant="h5" gutterBottom>
        Laissez-nous votre avis
      </Typography>

      <Box component="form" onSubmit={handleSubmit}>
        <Stack spacing={2}>
          <TextField
            name="firstName"
            label="Prénom"
            value={formData.firstName}
            onChange={handleChange}
            fullWidth
            required
          />
          <TextField
            name="lastName"
            label="Nom"
            value={formData.lastName}
            onChange={handleChange}
            fullWidth
            required
          />
          <TextField
            name="email"
            label="Email"
            type="email"
            value={formData.email}
            onChange={handleChange}
            fullWidth
            required
          />
          <TextField
            name="comment"
            label="Commentaire"
            value={formData.comment}
            onChange={handleChange}
            multiline
            rows={4}
            fullWidth
            required
          />
          <Button type="submit" variant="contained" color="primary">
            Envoyer
          </Button>
        </Stack>
      </Box>
    </Paper>
  );
};

export default FeedbackForm;
