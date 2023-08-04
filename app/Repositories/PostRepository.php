<?php

namespace App\Repositories;
use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use DB;

class PostRepository extends BaseRepository{
    public function create(array $attibutes){
        
        return DB::transaction(function() use ($attibutes){
            $created = Post::query()->create([
                'title' => data_get($attibutes, 'title', 'Untitled'),
                'body' => data_get($attibutes, 'body')
            ]);

            // if(!$created){
            //     throw new GeneralJsonException('failed to create post');
            // }

            throw_if(!$created, GeneralJsonException::class, 'Failed to create');

            if($userIds = data_get($attibutes, 'user_ids'))
            $created->users()->sync($userIds);

            return $created;
        });

    }

    public function update(Post $post, array $attibutes){
        return DB::transaction(function() use($post, $attibutes){
            $updated = $post->update([
                'title' => data_get($attibutes, 'title', $post->title),
                'body' => data_get($attibutes, 'body', $post->body)
            ]);

            if (!$updated) throw new GeneralJsonException("Gagal Update", 500);

            if($userIds = data_get($attibutes, 'user_ids'))
                $post->users()->sync($userIds);

            return $post;
        });
    }

    public function delete(Post $post){
        return DB::transaction(function() use ($post){
            $deleted = $post->forceDelete();

            if(!$deleted){
                return new \Exception("cannot delete post");
            }
            return $deleted;
        });
    }
}