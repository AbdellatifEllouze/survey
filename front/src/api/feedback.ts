import { FeedbackData } from '../types/feedback';

export async function submitFeedbackToAPI(feedback: FeedbackData) {
  const response = await fetch('http://localhost:8086/api/feedbacks/', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({...feedback }),
  });
  if (!response.ok) throw new Error('Failed to submit feedback');
  return response.json();
}
