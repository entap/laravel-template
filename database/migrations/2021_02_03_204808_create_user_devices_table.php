<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_devices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->constrained();
            $table->string('platform')->nullable();
            $table->integer('screen_width')->nullable();
            $table->integer('screen_height')->nullable();
            // `device_model` VARCHAR(20) NOT NULL COMMENT 'デバイスのモデル',
            // `device_name` VARCHAR(20) NOT NULL COMMENT 'デバイス名',
            // `device_type` INT NOT NULL COMMENT 'デバイスのタイプ',
            // `graphics_device_id` INT NOT NULL COMMENT 'グラフィックデバイスの識別コード',
            // `graphics_device_name` VARCHAR(20) NOT NULL COMMENT 'グラフィックデバイス名',
            // `graphics_device_type` INT NOT NULL COMMENT 'グラフィックデバイスのタイプ',
            // `graphics_device_vendor` VARCHAR(20) NOT NULL COMMENT 'グラフィックデバイスのベンダー',
            // `graphics_device_vendor_id` INT NOT NULL COMMENT 'グラフィックデバイスのベンダーの識別コード',
            // `graphics_device_version` VARCHAR(20) NOT NULL COMMENT 'グラフィックデバイスのAPIとバージョン',
            // `graphics_memory_size` INT NOT NULL COMMENT 'ビデオメモリ',
            // `graphics_multi_threaded` TINYINT(1) NOT NULL COMMENT 'グラフィックデバイスがマルチスレッドレンダリングを行うか？',
            // `graphics_shader_level` INT NOT NULL COMMENT 'グラフィックデバイスのシェーダーの性能レベル',
            // `max_texture_size` INT NOT NULL COMMENT 'テクスチャの最大サイズ',
            // `npot_support` INT NOT NULL COMMENT '対応しているNPOTテクスチャ',
            // `operating_system` VARCHAR(20) NOT NULL COMMENT 'OSとバージョン',
            // `processor_count` INT NOT NULL COMMENT 'プロセッサーの数',
            // `processor_frequency` INT NOT NULL COMMENT 'プロセッサーの周波数',
            // `processor_type` VARCHAR(20) NOT NULL COMMENT 'プロセッサー名',
            // `supported_render_target_count` INT NOT NULL COMMENT 'レンダリングターゲットの数',
            // `supports_2darray_textures` TINYINT(1) NOT NULL COMMENT '2D配列テクスチャに対応しているか？',
            // `supports_3dtextures` TINYINT(1) NOT NULL COMMENT '3Dテクスチャに対応しているか？',
            // `supports_accelerometer` TINYINT(1) NOT NULL COMMENT '加速度センサーに対応しているか？',
            // `supports_audio` TINYINT(1) NOT NULL COMMENT 'オーディオに対応しているか？',
            // `supports_compute_shaders` TINYINT(1) NOT NULL COMMENT 'ComputeShaderに対応しているか？',
            // `supports_gyroscope` TINYINT(1) NOT NULL COMMENT 'ジャイロスコープに対応しているか？',
            // `supports_image_effects` TINYINT(1) NOT NULL COMMENT 'イメージエフェクトに対応しているか？',
            // `supports_instancing` TINYINT(1) NOT NULL COMMENT 'GPUドローコールのインスタンス化に対応しているか？',
            // `supports_location_service` TINYINT(1) NOT NULL COMMENT 'GPSに対応しているか？',
            // `supports_motion_vectors` TINYINT(1) NOT NULL COMMENT 'モーションベクターに対応しているか？',
            // `supports_raw_shadow_depth_sampling` TINYINT(1) NOT NULL COMMENT 'シャドウマップからのサンプリングは生のデプスか？',
            // `supports_render_textures` TINYINT(1) NOT NULL COMMENT 'レンダリングテクスチャに対応しているか？',
            // `supports_render_to_cubemap` TINYINT(1) NOT NULL COMMENT 'キューブマップに対するレンダリングに対応しているか？',
            // `supports_shadows` TINYINT(1) NOT NULL COMMENT '影に対応しているか？',
            // `supports_sparse_textures` TINYINT(1) NOT NULL COMMENT 'スパーステクスチャに対応しているか？',
            // `supports_stencil` TINYINT(1) NOT NULL COMMENT 'ステンシルバッファに対応しているか？',
            // `supports_vibration` TINYINT(1) NOT NULL COMMENT 'バイブレーションに対応しているか？',
            // `system_memory_size` INT NOT NULL COMMENT 'システムメモリ',
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_devices');
    }
}
