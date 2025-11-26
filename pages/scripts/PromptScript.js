const input = document.querySelector('.prompt-input');
const button = document.querySelector('.prompt-button');
const display = document.querySelector('.prompt-display');
const clearBtn = document.querySelector('.clear-prompts-button');

function sendToDatabase(text) {
  fetch("/database/push_prompt.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "value=" + encodeURIComponent(text)
  })
  .then(response => response.text())
  .then(data => {
    console.log("response:", data);
    fetchPrompt("latest");
  })
  .catch(error => console.error("error:", error));
}

function fetchPrompt(option = "latest") {
  fetch('/database/get_prompts.php?nocache=' + Date.now())
    .then(res => res.json())
    .then(data => {
      if (!data || data.length === 0) return;

      let prompt;
      if (option === "latest") {
        prompt = data[0].prompt_text;
      } else if (option === "random") {
        const randomIndex = Math.floor(Math.random() * data.length);
        prompt = data[randomIndex].prompt_text;
      }

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

document.addEventListener("DOMContentLoaded", () => {
  if (display) {
    fetchPrompt("random");
  }
});

if (clearBtn) {
  clearBtn.addEventListener('click', () => {
    fetch('/database/clear_prompts.php', { method: 'POST' })
      .then(res => res.text())
      .then(msg => {
        alert(msg);
        display.textContent = '';
        localStorage.removeItem("currentPrompt");
      })
      .catch(err => console.error(err));
  });
}