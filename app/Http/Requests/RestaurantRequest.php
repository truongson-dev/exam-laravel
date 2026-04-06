<?php

namespace App\Http\Requests;

use App\Models\Restaurant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RestaurantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'category' => ['required', 'string', 'in:' . implode(',', Restaurant::categories())],
            'price' => ['required', 'numeric', 'min:1000', 'max:10000000'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'status' => ['required', 'in:0,1'],
        ];
    }

    /**
     * Custom error messages (Vietnamese)
     */
    public function messages(): array
    {
        return [
            'name.required' => '❌ Tên món ăn không được để trống.',
            'name.min' => '❌ Tên món ăn phải có ít nhất 3 ký tự.',
            'name.max' => '❌ Tên món ăn không được vượt quá 255 ký tự.',

            'category.required' => '❌ Vui lòng chọn danh mục món ăn.',
            'category.in' => '❌ Danh mục không hợp lệ. Chỉ chấp nhận: Cơm Dĩa, Bánh mỳ, Bú phở.',

            'price.required' => '❌ Giá tiền không được để trống.',
            'price.numeric' => '❌ Giá tiền phải là số.',
            'price.min' => '❌ Giá tiền phải lớn hơn 1.000 VNĐ.',
            'price.max' => '❌ Giá tiền không được vượt quá 10.000.000 VNĐ.',

            'description.max' => '❌ Mô tả không được vượt quá 1000 ký tự.',

            'image.image' => '❌ File phải là hình ảnh.',
            'image.mimes' => '❌ Chỉ chấp nhận ảnh định dạng: jpeg, png, jpg, webp.',
            'image.max' => '❌ Kích thước ảnh không được vượt quá 2MB.',

            'status.required' => '❌ Vui lòng chọn trạng thái.',
            'status.in' => '❌ Trạng thái không hợp lệ.',
        ];
    }

    /**
     * Custom attribute names
     */
    public function attributes(): array
    {
        return [
            'name' => 'Tên món ăn',
            'category' => 'Danh mục',
            'price' => 'Giá tiền',
            'description' => 'Mô tả',
            'image' => 'Hình ảnh',
            'status' => 'Trạng thái',
        ];
    }

    /**
     * If validation fails, redirect back with errors
     * displayed at the TOP of the form
     */
    protected function failedValidation(Validator $validator)
    {
        // For API requests, throw JSON
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422)
            );
        }

        // For web requests: flash all errors to session and redirect back
        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($validator)
                ->withInput()
        );
    }
}