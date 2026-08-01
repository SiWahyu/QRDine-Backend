<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'table_id' => ['required', 'exists:dining_tables,id'],

            'customer_name' => ['required', 'string', 'max:100'],

            'customer_email' => ['nullable', 'email'],

            'customer_phone' => [
                'required',
                'regex:/^08[0-9]{8,13}$/'
            ],

            'payment_method' => [
                'required',
                'in:cash,online'
            ],

            'items' => [
                'required',
                'array',
                'min:1'
            ],

            'items.*.menu_id' => [
                'required',
                'exists:menus,id'
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'table_id.required' => 'Meja wajib dipilih.',
            'table_id.exists' => 'Meja tidak ditemukan.',

            'customer_name.required' => 'Nama customer wajib diisi.',

            'customer_email.email' => 'Format email tidak valid.',

            'customer_phone.required' => 'Nomor HP wajib diisi.',
            'customer_phone.regex' => 'Nomor HP tidak valid.',

            'payment_method.in' => 'Metode pembayaran tidak valid.',

            'items.required' => 'Pesanan tidak boleh kosong.',
            'items.min' => 'Minimal terdapat satu menu.',

            'items.*.menu_id.exists' => 'Menu tidak ditemukan.',

            'items.*.quantity.min' => 'Jumlah minimal 1.',
        ];
    }
}
