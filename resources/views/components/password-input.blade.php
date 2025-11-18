@props([
    'id',
    'name',
    'placeholder' => '',
    'required' => false,
    'value' => '',
    'error' => false,
    'label' => null,
])

@if($label)
<div class="form-group">
    <label for="{{ $id }}">{{ $label }} @if($required)<span class="required">*</span>@endif</label>
@endif

    <div class="password-input-wrapper">
        <input 
            type="password" 
            id="{{ $id }}" 
            name="{{ $name }}" 
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            class="password-input {{ $error ? 'error' : '' }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes }}
        >
        <button type="button" class="password-toggle" onclick="togglePassword('{{ $id }}')">
            <svg class="eye-icon eye-open" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
            <svg class="eye-icon eye-closed" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                <line x1="1" y1="1" x2="23" y2="23"></line>
            </svg>
        </button>
    </div>

@if($label)
</div>
@endif

@push('styles')
<style>
    .password-input-wrapper {
        position: relative;
        width: 100%;
    }

    .password-input {
        width: 100%;
        padding: 14px 45px 14px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .password-input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .password-input.error {
        border-color: #f44;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        padding: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        transition: all 0.2s ease;
        border-radius: 6px;
    }

    .password-toggle:hover {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }

    .password-toggle:active {
        transform: translateY(-50%) scale(0.95);
    }

    .eye-icon {
        transition: all 0.2s ease;
    }
</style>
@endpush

@once
@push('scripts')
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const wrapper = input.parentElement;
        const eyeOpen = wrapper.querySelector('.eye-open');
        const eyeClosed = wrapper.querySelector('.eye-closed');
        
        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.style.display = 'none';
            eyeClosed.style.display = 'block';
        } else {
            input.type = 'password';
            eyeOpen.style.display = 'block';
            eyeClosed.style.display = 'none';
        }
    }
</script>
@endpush
@endonce
