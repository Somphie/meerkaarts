const input = document.querySelector('.prompt-input');
const button = document.querySelector('.prompt-button');
const display = document.querySelector('.prompt-display');
const clearBtn = document.querySelector('.clear-prompts-button');

function sendToDatabase(text) {
  fetch("/database/push_prompt.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "value=" + encodeURIComponent(text)
  })
    .then(response => response.text())
    .then(data => {
      console.log("response:", data);
    })
    .catch(error => {
      console.error("error:", error);
    });
}

function fetchLatestPrompt() {
  fetch('/database/get_prompts.php')
    .then(res => res.json())
    .then(data => {
      const prompt = data.prompt_text || '';
      display.textContent = prompt;
      localStorage.setItem("currentPrompt", prompt);
    })
    .catch(err => console.error(err));
}

if (input && button) {
  button.addEventListener('click', () => {
    const value = input.value.trim();
    if (!value) return;

    sendToDatabase(value);

    input.value = '';
  });
}

if (display) {
  fetchLatestPrompt();
}

if (clearBtn) {
  clearBtn.addEventListener('click', () => {
    fetch('/database/clear_prompts.php', {
      method: 'POST'
    })
    .then(res => res.text())
    .then(msg => alert(msg))
    .catch(err => console.error(err));
  });
}