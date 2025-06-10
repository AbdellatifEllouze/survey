import { useState } from 'react';
import { FeedbackData } from '../../types/feedback';
import { useNavigate } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';
import { submitFeedbackToAPI } from '../../api/feedback';

export function useFeedback() {

    const navigate = useNavigate();
    const [formData, setFormData] = useState<FeedbackData>({
        firstName: '',
        lastName: '',
        email: '',
        comment: '',
    });

  const { mutate: submitFeedback, isPending, error } = useMutation({
    mutationFn: (formData: FeedbackData) => submitFeedbackToAPI(formData),
    onSuccess: () => {
      navigate('/'); // Navigate after successful submission
      setFormData({
        firstName: '', 
        lastName: '',
        email: '',
        comment: '',
      });
    },
    onError: (err) => {
      console.error('Error submitting rating:', err);
      // Optionally show an error message
    },
  });

    const handleChange = (
        e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>
    ) => {
        const { name, value } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value,
        }));
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        submitFeedback(formData);
    };

    return {
        formData,
        handleChange,
        handleSubmit,
        setFormData,
        isSubmitting: isPending, // Useful for UI loading states
        error, // Error handling
    };
}