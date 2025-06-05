import { useState } from 'react';

export function useRating() {
  const [value, setValue] = useState<number | null>(0);
  const [hover, setHover] = useState<number>(-1);

    return {
        value, 
        setValue, 
        hover, 
        setHover
    };
}