import React from 'react';
import { Box, Typography, Rating, Grid, Button } from '@mui/material';
import {Star} from '@mui/icons-material';
import { useRating } from './useRating';
import { ratingStyles } from './style';
import { useNavigate } from 'react-router-dom';
const RatingComponent: React.FC = () => {
const navigate = useNavigate();
const {  value, setValue, hover, setHover } = useRating();
const submitRating = () => {
    navigate('/feedback')
    // alert(`Vous avez noté: ${value}/10`);
    setValue(0);
    setHover(-1);
};

  return (
   <Grid container spacing={2} flexDirection={"column"} justifyContent="center" alignItems="center" style={{ height: '100vh' }}>
        <Box
            sx={ratingStyles.container}
        >
            <Typography variant="h6">Would you recommend our service to others?</Typography>

            <Rating
                name="rating-sur-10"
                value={value}
                precision={1}
                max={10}
                onChange={(_, newValue) => setValue(newValue)}
                onChangeActive={(_, newHover) => setHover(newHover)}
                icon={<Star fontSize="inherit" />}
                emptyIcon={<Star fontSize="inherit" />}
            />

            <Typography variant="body2" color="text.secondary">
                {hover !== -1 ? `${hover}/10` : `${value}/10`}
            </Typography>
        </Box>
        <Button
            variant="contained"
            color="primary"
            onClick={submitRating}
            style={{ marginTop: '20px' }}
        >
            Soumettre
        </Button>
   </Grid>
  );
};

export default RatingComponent;
