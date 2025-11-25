const input = document.querySelector('.prompt-input');
const button = document.querySelector('.prompt-button');

if (input && button) {
  button.addEventListener('click', () => {
    const value = input.value.trim();
    if (!value) return;

    let prompts = JSON.parse(localStorage.getItem('prompts')) || [];

    prompts.push(value);
    localStorage.setItem('prompts', JSON.stringify(prompts));

    console.log("Prompts:", prompts);
    input.value = '';
  });
}

const display = document.querySelector('.prompt-display');

if (display) {
  let prompts = JSON.parse(localStorage.getItem('prompts')) || [];

  if (prompts.length > 0) {
    const randomIndex = Math.floor(Math.random() * prompts.length);
    const randomPrompt = prompts[randomIndex];

    display.textContent = randomPrompt;

    localStorage.setItem("currentPrompt", randomPrompt);

  } else {
    display.textContent = "Voeg een prompt toe SAMUEL";
    localStorage.setItem("currentPrompt", "masterpiece");
  }
}

const clearBtn = document.querySelector('.clear-prompts-button');

if (clearBtn) {
  clearBtn.addEventListener('click', () => {
    localStorage.removeItem('prompts');
    alert("Alle prompts gewist!");
  });
}