<div class="drag-n-drop">
    <input
        type="file"
        @if(isset($model)) wire:model="{{ $model }}" @endif
    >

    <div id="drop-area">
        @if(isset($content))
            <div class="content content--custom">
                {{ $content }}
            </div>
        @else
            <div class="content content--default">
                @if(isset($icon))
                    <div class="content__icon">
                        <i class="{{ $icon }}"></i>
                    </div>
                @endif

                @if(isset($title))
                    <div class="content__title">
                        {!! __($title) !!}
                    </div>
                @endif

                @if(isset($description))
                    <div class="content__desc">
                        {!! __($description) !!}
                    </div>
                @endif
            </div>
        @endif
    </div>

    @if(isset($model))
        @error($model)
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
        @enderror
    @endif

    <script>
        let container = document.querySelector('.drag-n-drop')
        let fileInput = container.querySelector('input[type="file"]')
        let dropArea = container.querySelector('#drop-area')

        ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, (e) => {
                e.preventDefault()
                e.stopPropagation()
            })
        })

        ;['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, (e) => {
                e.target.classList.add('is-highlighted')
            })
        })

        ;['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, (e) => {
                e.target.classList.remove('is-highlighted')
            })
        })

        dropArea.addEventListener('drop', (e) => {
            fileInput.files = e.dataTransfer.files
            fileInput.dispatchEvent(new Event('change'))
        })

        dropArea.addEventListener('click', () => {
            fileInput.click()
        })

        document.addEventListener('livewire-upload-progress', (e) => {
            let progressContent = document.createElement('div')
            progressContent.classList.add('content')
            progressContent.classList.add('upload-progress')

            let progressPercentage = document.createElement('div')
            progressPercentage.classList.add('upload-progress__percentage')
            progressPercentage.innerHTML = `${e.detail.progress}%`

            let progressLine = document.createElement('div')
            progressLine.classList.add('upload-progress__line')

            let progressLineInner = document.createElement('div')
            progressLineInner.classList.add('upload-progress__line-inner')
            progressLineInner.style.width = `${e.detail.progress}%`

            progressLine.append(progressLineInner)
            progressContent.append(progressPercentage)
            progressContent.append(progressLine)

            document.querySelector('.drag-n-drop .content').replaceWith(progressContent)
        })
    </script>
</div>
