const input = document.querySelector('.prompt-input');
const button = document.querySelector('.prompt-button');

    button.addEventListener('click', () => {
        const value = input.value.trim();
        if (!value) return;

    let prompts = JSON.parse(localStorage.getItem('prompts')) || [];

    prompts.push(value);

    localStorage.setItem('prompts', JSON.stringify(prompts));

    console.clear();
    console.log("Prompts", prompts);

    input.value = '';
});