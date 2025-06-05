import { useMutation } from '@tanstack/react-query';
import axios from 'axios';
import { FeedbackData } from '../types/feedback';

export const useSubmitFeedback = () =>
  useMutation({
    mutationFn: async (data: FeedbackData) => {
      const res = await axios.post('/api/feedback', data);
      return res.data;
    },
  });
