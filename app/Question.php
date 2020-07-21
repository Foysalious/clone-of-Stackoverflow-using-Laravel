<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // Mass Assignment
    protected $fillable = ['title','body'];
    protected $appends= ['create_date'];
    
    // one to many(inverse)
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function getUrlAttribute(){
        return route('questions.show',  $this->slug);
    }
    
    public function setTitleAttribute($value){
        $this->attributes['title']=$value;
        $this->attributes['slug']=str_slug($value);
    }
    
    public function getCreateDateAttribute(){
        return $this->created_at->diffForHumans();
    }
    
    public function getStatusAttribute(){
        if($this-> answers_count > 0){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
    
    public function getBodyHtmlAttribute(){
        return clean(\Parsedown::instance()->text($this->body));
    }
    
    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function bestAcceptAnswer(Answer $answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }
    public function favorites(){
        return $this->belongsToMany(User::class,'favorites')
            ->withTimestamps();
    }
    public function isFavorited(){
        return $this->favorites()->where('user_id',auth()->id())
            ->count() > 0;
    }
    public function getIsFavoritedAttribute(){
        return $this->isFavorited();
    }
    
    public function getFavoritesCountAttribute(){
        return $this->favorites()->count();
    }
    
    public function votes(){
        return $this->morphToMany(User::class, 'votable')
            -> withTimestamps();
    }
    
    public function upVotes(){
        return $this->votes()->wherePivot('vote', 1);
    }
    public function downVotes(){
        return $this->votes()->wherePivot('vote', -1);
    }
    
}
