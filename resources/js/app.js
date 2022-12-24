import 'livewire-sortable';
import './bootstrap';
import './editor';

document.addEventListener("DOMContentLoaded",  () => {
    handleModal()
})

window.openModal = function openModal(view, params = null) {
    Livewire.emit("openModal", view, params)
}

window.editTitle = function editTitle(el) {
    let input = document.createElement("input");
    input.value = el.innerText;

    el.parentNode.replaceChild(input, el);
    input.focus();

    input.addEventListener("keyup", (e) => {
        if (e.key === "Enter") save();
        if (e.key === "Escape") discard();
    });

    input.addEventListener("focusout", () => {
        save();
    });

    const save = () => {
        const item = input.closest("[wire\\:id]");
        const itemId = item.getAttribute("data-id");

        if (el.innerText !== input.value) {
            Livewire.emit("updateItem", itemId, {"title": input.value});
        }

        el.innerText = input.value;
        discard();
    }

    const discard = () => {
        input.parentNode.replaceChild(el, input);
        input.blur();
    }
}

function handleModal () {
    let modalEl

    window.addEventListener("modalRendered", () => {
        modalEl = document.querySelector("#modal")
        new bootstrap.Modal(modalEl).show()
    })

    document.addEventListener("hidden.bs.modal", () => {
        modalEl.remove()
    })
}
