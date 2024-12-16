<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuNews extends Model
{
    // Khai báo bảng tương ứng với model (nếu khác với tên model theo chuẩn Laravel)
    protected $table = 'menu_news';

    // Khai báo các cột có thể thao tác (mass assignable)
    protected $fillable = ['name', 'parent_id', 'url', 'position', 'is_active'];

    /**
     * Quan hệ đệ quy để lấy menu con (submenus)
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }
    
    public function submenu()
    {
        return $this->hasMany(MenuNews::class, 'parent_id');
    }

    /**
     * Quan hệ để lấy menu cha
     */
    public function parentMenu()
    {
        return $this->belongsTo(MenuNews::class, 'parent_id');
    }

    /**
     * Phạm vi truy vấn các menu cha (cấp 1)
     */
    public function scopeParentMenus($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Phạm vi truy vấn các menu con của một menu cụ thể
     */
    public function scopeSubMenusOf($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }
}
