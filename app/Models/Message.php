<?php

namespace Diskourse\Models;
use Illuminate\Database\Eloquent\Model;

class Message extends Model {
	protected $table='messages';
	protected $fillable= [
	'body'
	];

	public function user() {
		return $this->belongsTo('Diskourse\Models\User', 'user_id');
	}

	public function scopeNotReply($query) {
		return $query->whereNull('parent_id');
	}

	public function replies() {
		return $this->hasMany('Diskourse\Models\Message', 'parent_id');
	}

}