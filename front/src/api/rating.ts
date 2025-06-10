export async function submitRatingToAPI(rating: number | null) {
  const response = await fetch('http://localhost:8086/api/survey-responses/', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({score: rating }),
  });
  if (!response.ok) throw new Error('Failed to submit rating');
  return response.json();
}