document.addEventListener('DOMContentLoaded', () => {
    const actions = document.querySelectorAll('.action');

    actions.forEach(action => {
        action.addEventListener('click', () => {
            const subActions = action.querySelectorAll('.sub-action');
            subActions.forEach(subAction => {
                if (subAction.style.display === 'none' || !subAction.style.display) {
                    subAction.style.display = 'block';
                } else {
                    subAction.style.display = 'none';
                }
            });
        });
    });
});
