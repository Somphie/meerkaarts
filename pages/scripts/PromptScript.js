const input = document.querySelector('.prompt-input');
const button = document.querySelector('.prompt-button');
const display = document.querySelector('.prompt-display');
const clearBtn = document.querySelector('.clear-prompts-button');

if (input && button) {
  button.addEventListener('click', () => {
    const value = input.value.trim();
    if (!value) return;

    fetch('save_prompt.php', {
      method: 'POST',
      body: new URLSearchParams({ prompt: value })
    })
    .then(res => res.text())
    .then(msg => console.log(msg))
    .catch(err => console.error(err));

    input.value = '';
  });
}

if (display) {
  fetch('get_prompt.php')
    .then(res => res.text())
    .then(prompt => {
      display.textContent = prompt;
      localStorage.setItem("currentPrompt", prompt);
    })
    .catch(err => console.error(err));
}

if (clearBtn) {
  clearBtn.addEventListener('click', () => {
    fetch('clear_prompts.php')
      .then(res => res.text())
      .then(msg => alert(msg))
      .catch(err => console.error(err));
  });
}