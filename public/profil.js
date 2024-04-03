

document.addEventListener('DOMContentLoaded', function() {
    const toggleItems = document.querySelectorAll('.toggle-table');

    toggleItems.forEach(function(item) {
        item.addEventListener('click', function() {
            const sublistItems = this.parentElement.querySelectorAll('li:not(.toggle-table)');
            sublistItems.forEach(function(subitem) {
                subitem.classList.toggle('hidden');
            });

            const handPointerIcon = this.querySelector('.fa-hand-pointer');
            const handPointDownIcon = this.querySelector('.fa-hand-point-down');
            handPointerIcon.classList.toggle('hidden');
            handPointDownIcon.classList.toggle('hidden');
        });
    });
});

