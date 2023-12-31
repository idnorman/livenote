<?php

namespace App\Repositories;
use App\Events\Models\User\UserCreated;
use App\Events\Models\User\UserDeleted;
use App\Events\Models\User\UserUpdated;
use App\Exceptions\GeneralJsonException;
use App\Models\User;
use DB;

class UserRepository extends BaseRepository{
    public function create(array $attibutes){
        
        return DB::transaction(function() use ($attibutes){
            $created = User::query()->create([
                'name' => data_get($attibutes, 'name'),
                'email' => data_get($attibutes, 'email'),
                'password' => data_get($attibutes, 'password')
            ]);

            if(!$created) throw new GeneralJsonException('failed to create User', 500);

            event(new UserCreated($created));

            return $created;
        });

    }

    public function update(User $user, array $attibutes){
        return DB::transaction(function() use($user, $attibutes){
            $updated = $user->update([
                'name' => data_get($attibutes, 'name', $user->name),
                'email' => data_get($attibutes, 'email', $user->email),
                'password' => data_get($attibutes, 'password', $user->password)
            ]);

            if (!$updated) throw new GeneralJsonException("Gagal Update", 500);
            event(new UserUpdated($updated));
            
            return $user;
        });
    }

    public function delete(User $user){
        return DB::transaction(function() use ($user){
            $deleted = $user->forceDelete();

            if(!$deleted){
                return new \Exception("cannot delete User");
            }
            event(new UserDeleted($user));
            return $deleted;
        });
    }
}