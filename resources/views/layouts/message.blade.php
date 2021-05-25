@if(isset($messageType))
    <style>
        @keyframes slideLeft {
            from {
                right: -50%;
            }
            to {
                right: 2rem;
            }
        }
        .message-animation {
            animation: slideLeft 300ms ease;
            animation-iteration-count: 1;
        }
    </style>
    <div class="fixed top-4 right-8 z-10 shadow-md border-2 bg-white p-4 max-w-md message-animation transition-opacity duration-200" id="notification-message">
        <x-dynamic-component :component="$messageType">
            <x-slot name="closeButton">
                <span class="absolute right-0 text-gray-600 cursor-pointer" onclick="closeMessage()">
                    <x-heroicon-o-x class="w-5" />
                </span>
            </x-slot>
            <p class="text-lg">{{ $messageText }}</p>
        </x-dynamic-component>
    </div>
    <script>
        function closeMessage() {
            const message = document.getElementById('notification-message');
            message.classList.add('opacity-0');
            setTimeout(() => message.style.display = 'none', 200);
        }
        setTimeout(closeMessage, 5000);
    </script>
@endif
