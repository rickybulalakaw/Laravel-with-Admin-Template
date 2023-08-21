@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input w-full dark:text-white border-slate-700  dark:bg-slate-800']) !!}>
