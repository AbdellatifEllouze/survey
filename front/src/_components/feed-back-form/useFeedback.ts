import { useState } from 'react';
import { FeedbackData } from '../../types/feedback';



export function useFeedback() {
    const [formData, setFormData] = useState<FeedbackData>({
        firstName: '',
        lastName: '',
        email: '',
        comment: '',
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
        console.log('Feedback envoyé :', formData);
        // TODO: send to backend (API POST)
    };

    return {
        formData,
        handleChange,
        handleSubmit,
        setFormData,
    };
}