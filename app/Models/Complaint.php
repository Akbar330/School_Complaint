<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_code',
        'user_id',
        'category_id',
        'subject',
        'description',
        'priority',
        'status',
        'attachment',
    ];

    /**
     * Get the user that owns the complaint
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of the complaint
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get priority color attribute (Laravel 12 style)
     */
    protected function priorityColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->priority) {
                'high' => 'red',
                'medium' => 'orange',
                'low' => 'blue',
                default => 'gray',
            }
        );
    }

    /**
     * Get priority label attribute
     */
    protected function priorityLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->priority) {
                'high' => 'High Priority',
                'medium' => 'Medium Priority',
                'low' => 'Low Priority',
                default => 'Unknown',
            }
        );
    }

    /**
     * Get status color attribute
     */
    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->status) {
                'pending' => 'yellow',
                'in_progress' => 'blue',
                'resolved' => 'green',
                default => 'gray',
            }
        );
    }

    /**
     * Get status label attribute
     */
    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->status) {
                'pending' => 'Pending',
                'in_progress' => 'In Progress',
                'resolved' => 'Resolved',
                default => 'Unknown',
            }
        );
    }

    /**
     * Get attachment URL
     */
    protected function attachmentUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attachment ? asset('storage/' . $this->attachment) : null
        );
    }

    /**
     * Scope a query to only include complaints with specific status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include complaints with specific priority
     */
    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope a query to only include pending complaints
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include resolved complaints
     */
    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }
}