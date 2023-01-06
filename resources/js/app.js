import 'livewire-sortable';
import './bootstrap';
import './editor';

document.addEventListener("DOMContentLoaded",  () => {
    initTooltips()
    handleModal()
})

window.openModal = function openModal(view, params = null, defaults = null) {
    Livewire.emit("openModal", view, params, defaults)
}

window.closeModal = function closeModal() {
    let modal = document.querySelector("#modal");
    bootstrap.Modal.getInstance(modal).hide()
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
        const item = input.closest("[wire\\:id]").getAttribute("wire:id");

        if (el.innerText !== input.value) {
            Livewire.find(item).update({"title": input.value})
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

    document.addEventListener("closeModal", () => {
        closeModal()
    })

    document.addEventListener("hidden.bs.modal", () => {
        modalEl.remove()
    })
}

function initTooltips() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
}
