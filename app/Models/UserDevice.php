<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 使用する端末
 */
class UserDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'platform',
        'package',
        'package_version',
        'screen_width',
        'screen_height',
        'device_model',
        'device_name',
        'device_type',
        'graphics_device_id',
        'graphics_device_name',
        'graphics_device_type',
        'graphics_device_vendor',
        'graphics_device_vendor_id',
        'graphics_device_version',
        'graphics_memory_size',
        'graphics_multi_threaded',
        'graphics_shader_level',
        'max_texture_size',
        'npot_support',
        'operating_system',
        'processor_count',
        'processor_frequency',
        'processor_type',
        'supported_render_target_count',
        'supports_2darray_textures',
        'supports_3dtextures',
        'supports_accelerometer',
        'supports_audio',
        'supports_compute_shaders',
        'supports_gyroscope',
        'supports_image_effects',
        'supports_instancing',
        'supports_location_service',
        'supports_motion_vectors',
        'supports_raw_shadow_depth_sampling',
        'supports_render_textures',
        'supports_render_to_cubemap',
        'supports_shadows',
        'supports_sparse_textures',
        'supports_stencil',
        'supports_vibration',
        'system_memory_size',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
