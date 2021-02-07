<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserDeviceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => 'required',
            'platform' => 'nullable|string|max:255',
            'package' => 'nullable|string|max:255',
            'package_version' => 'nullable|string|max:255',
            'screen_width' => 'nullable|integer',
            'screen_height' => 'nullable|integer',
            'device_model' => 'nullable|string|max:255',
            'device_name' => 'nullable|string|max:255',
            'device_type' => 'nullable|string|max:255',
            'graphics_device_id' => 'nullable|string|max:255',
            'graphics_device_name' => 'nullable|string|max:255',
            'graphics_device_type' => 'nullable|string|max:255',
            'graphics_device_vendor' => 'nullable|string|max:255',
            'graphics_device_vendor_id' => 'nullable|string|max:255',
            'graphics_device_version' => 'nullable|string|max:255',
            'graphics_memory_size' => 'nullable|integer',
            'graphics_multi_threaded' => 'nullable|boolean',
            'graphics_shader_level' => 'nullable|integer',
            'max_texture_size' => 'nullable|integer',
            'npot_support' => 'nullable|integer',
            'operating_system' => 'nullable|string|max:255',
            'processor_count' => 'nullable|integer',
            'processor_frequency' => 'nullable|integer',
            'processor_type' => 'nullable|string|max:255',
            'supported_render_target_count' => 'nullable|integer',
            'supports_2darray_textures' => 'nullable|boolean',
            'supports_3dtextures' => 'nullable|boolean',
            'supports_accelerometer' => 'nullable|boolean',
            'supports_audio' => 'nullable|boolean',
            'supports_compute_shaders' => 'nullable|boolean',
            'supports_gyroscope' => 'nullable|boolean',
            'supports_image_effects' => 'nullable|boolean',
            'supports_instancing' => 'nullable|boolean',
            'supports_location_service' => 'nullable|boolean',
            'supports_motion_vectors' => 'nullable|boolean',
            'supports_raw_shadow_depth_sampling' => 'nullable|boolean',
            'supports_render_textures' => 'nullable|boolean',
            'supports_render_to_cubemap' => 'nullable|boolean',
            'supports_shadows' => 'nullable|boolean',
            'supports_sparse_textures' => 'nullable|boolean',
            'supports_stencil' => 'nullable|boolean',
            'supports_vibration' => 'nullable|boolean',
            'system_memory_size' => 'nullable|integer',
        ];
    }
}
