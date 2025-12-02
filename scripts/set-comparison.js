document.addEventListener("DOMContentLoaded", () => {
  const input1 = document.getElementById('text-input-1');
  const input2 = document.getElementById('text-input-2');
  const resultDiv = document.getElementById('common-words-result');

  if (!input1 || !input2 || !resultDiv) return;

  function normalizeWord(word) {
    return word.toLowerCase().replace(/[.,!?;:()\[\]{}'"]/g, '');
  }

  function getWordsSet(text) {
    if (!text || text.trim() === '') return new Set();
    const words = text.trim().split(/\s+/);
    const wordsSet = new Set();
    words.forEach(word => {
      const normalized = normalizeWord(word);
      if (normalized.length > 0) {
        wordsSet.add(normalized);
      }
    });
    return wordsSet;
  }

  function findCommonWords(text1, text2) {
    const set1 = getWordsSet(text1);
    const set2 = getWordsSet(text2);
    
    const commonWords = new Set();
    set1.forEach(word => {
      if (set2.has(word)) {
        commonWords.add(word);
      }
    });
    
    return Array.from(commonWords);
  }

  function updateResult() {
    const value1 = input1.value;
    const value2 = input2.value;
    
    if (!value1.trim() || !value2.trim()) {
      resultDiv.innerHTML = '<p class="has-text-grey">Введіть текст в обидва поля для порівняння</p>';
      return;
    }

    const commonWords = findCommonWords(value1, value2);
    
    if (commonWords.length === 0) {
      resultDiv.innerHTML = '<p class="has-text-danger">Спільних слів не знайдено</p>';
    } else {
      const wordsList = commonWords.map(word => `<span class="tag is-primary">${word}</span>`).join(' ');
      resultDiv.innerHTML = `
        <p class="has-text-success"><strong>Спільні слова (${commonWords.length}):</strong></p>
        <div class="tags" style="margin-top: 10px;">
          ${wordsList}
        </div>
      `;
    }
  }

  input1.addEventListener('input', updateResult);
  input2.addEventListener('input', updateResult);
  
  updateResult();
});

