
export function stripTagsAndLimit(text, maxLength) {
  
  const strippedText = text ?   text.replace(/(<([^>]+)>)/gi, '') : 'no text'; // Remove HTML tags
  return strippedText.length > maxLength
    ? strippedText.substring(0, maxLength) + '...' // Limit characters
    : strippedText;
}
