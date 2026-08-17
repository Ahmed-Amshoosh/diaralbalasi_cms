<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model {
    protected $fillable = ['name', 'phone', 'email', 'subject', 'message', 'is_read'];
    protected $casts = ['is_read' => 'boolean'];

    // Scope للرسائل غير المقروءة
    public function scopeUnread($query) {
        return $query->where('is_read', false);
    }

    // Scope للرسائل المقروءة
    public function scopeRead($query) {
        return $query->where('is_read', true);
    }

    // عداد الرسائل غير المقروءة (للعرض في القائمة الجانبية)
    public static function unreadCount() {
        return self::unread()->count();
    }
}
