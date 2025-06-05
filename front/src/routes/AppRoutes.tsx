import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import Home from '../pages/Home';
import FeedbackPage from '../pages/FeedbackPage';

const router = createBrowserRouter([
  { path: '/', element: <Home /> },
  { path: '/feedback', element: <FeedbackPage /> },
]);

export default function AppRoutes() {
  return <RouterProvider router={router} />;
}
