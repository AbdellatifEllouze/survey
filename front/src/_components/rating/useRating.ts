import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';
import { submitRatingToAPI } from '../../api/rating';

export function useRating() {
  const navigate = useNavigate();
  const [value, setValue] = useState<number | null>(0);
  const [hover, setHover] = useState<number>(-1);

  // Use React Query's useMutation for API submission
  const { mutate: submitRating, isPending, error } = useMutation({
    mutationFn: (value: number | null) => submitRatingToAPI(value),
    onSuccess: () => {
      navigate('/feedback'); // Navigate after successful submission
      setValue(0); // Reset form
      setHover(-1);
    },
    onError: (err) => {
      console.error('Error submitting rating:', err);
      // Optionally show an error message
    },
  });

  const handleSubmit = () => {
    if (value !== null) {
      submitRating(value); // Trigger the mutation
    }
  };

  return {
    value,
    setValue,
    hover,
    setHover,
    submitRating: handleSubmit, // Updated to use mutation
    isSubmitting: isPending, // Useful for UI loading states
    error, // Error handling
  };
}