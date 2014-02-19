<?php

class Post extends BaseModel
{
    /**
     * Rules for form validator
     * @var array rules
     */
    public static $rules = [
        'title' => 'required|unique:posts',
        'post' => 'required',
        'status' => 'required',
    ];

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
     * function comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('\Comment');
    }


    /**
     * Creating or editing a post
     *
     * @param array $inputValues    input values from form
     *
     * @return bool
     */
    public function savePost(array $inputValues)
    {
        $this->setRecordParams($inputValues);
        $this->slug = $this->generateSlug($this->title);
        $this->admin_id = Auth::admin()->user()->id;
        return $this->save();
    }

    /**
     * Generate a slug of given string - spider friendly
     *
     * @param        $string    a string to slugify
     * @param string $space     OPTIONAL every spice will be replace by "-" or whatever you pass
     *
     * @return bool|mixed|string
     */
    private function generateSlug($string, $space="-")
    {
        if (function_exists('iconv'))
        {
            $string = @iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        }

        $string = preg_replace("/[^a-zA-Z0-9 -]/", "", $string);
        $string = strtolower($string);
        $string = str_replace(" ", $space, $string);

        return $string;
    }

}
