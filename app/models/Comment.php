<?php

class Comment extends BaseModel
{
    protected $guarded = array();

    public function __construct(array $attributes = array())
    {
        if( !isset($attributes['user_id']) && Auth::user()->check() )
        {
            $attributes['user_id'] = Auth::user()->user()->id;
        }

        if( !isset($attributes['admin_id']) && Auth::admin()->check() )
        {
            $attributes['admin_id'] = Auth::admin()->user()->id;
        }

        parent::__construct($attributes);
    }

    /**
     * function post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('\Post');
    }

    /**
     * function user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\User');
    }

    /**
     * function admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('\Admin');
    }

    /**
     * Getting an comment author details - it could be an admin or user
     *
     * @return \stdClass
     */
    public function getAuthor()
    {
        $author = new \stdClass();
        $author->isAdmin = false;
        $author->nick = null;
        $author->email = null;

        if( !is_null($this->admin) )
        {
            $author->isAdmin = true;
            $author->nick = $this->admin->nick;
            $author->email = $this->admin->email;
        }
        elseif( !is_null($this->user) )
        {
            $author->nick = $this->user->nick;
            $author->email = $this->user->email;
        }

        return $author;
    }

}
