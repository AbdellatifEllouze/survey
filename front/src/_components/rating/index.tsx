import React from 'react';
import { Box, Typography, Rating, Grid, Button } from '@mui/material';
import {Star} from '@mui/icons-material';
import { useRating } from './useRating';
import { ratingStyles } from './style';

const RatingComponent: React.FC = () => {
const {  value, setValue, hover, setHover, submitRating } = useRating();

  return (
   <Grid container spacing={2} flexDirection={"column"} justifyContent="center" alignItems="center" height={'100vh'}>
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
            style={ratingStyles.button}
        >
            Soumettre
        </Button>
   </Grid>
  );
};

export default RatingComponent;
