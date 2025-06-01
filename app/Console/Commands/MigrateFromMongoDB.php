<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MigrateFromMongoDB extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'migrate:from-mongodb {--file=mongodb_export.json}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Migrate data from MongoDB export to Laravel database';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $file = $this->option('file');

    if (!file_exists($file)) {
      $this->error("File {$file} not found!");
      return 1;
    }

    $this->info("Starting migration from {$file}...");

    $data = json_decode(file_get_contents($file), true);

    if (!$data) {
      $this->error("Invalid JSON file!");
      return 1;
    }

    DB::beginTransaction();

    try {
      // Migrate users
      if (isset($data['users'])) {
        $this->info("Migrating users...");
        $userMapping = [];

        foreach ($data['users'] as $userData) {
          $user = User::create([
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password'] ?? 'password123'),
            'avatar_index' => $userData['avatarIndex'] ?? 0,
            'created_at' => isset($userData['createdAt']) ? date('Y-m-d H:i:s', strtotime($userData['createdAt'])) : now(),
            'updated_at' => isset($userData['updatedAt']) ? date('Y-m-d H:i:s', strtotime($userData['updatedAt'])) : now(),
          ]);

          $userMapping[$userData['_id']] = $user->id;
          $this->info("Migrated user: {$user->username}");
        }
      }

      // Migrate tasks
      if (isset($data['tasks']) && isset($userMapping)) {
        $this->info("Migrating tasks...");

        foreach ($data['tasks'] as $taskData) {
          if (!isset($userMapping[$taskData['userId']])) {
            $this->warn("Skipping task: User not found for userId {$taskData['userId']}");
            continue;
          }

          Task::create([
            'user_id' => $userMapping[$taskData['userId']],
            'title' => $taskData['title'],
            'note' => $taskData['note'] ?? '',
            'date' => $taskData['date'],
            'time' => $taskData['time'],
            'colorindex' => $taskData['colorindex'] ?? 0,
            'created_at' => isset($taskData['createdAt']) ? date('Y-m-d H:i:s', strtotime($taskData['createdAt'])) : now(),
            'updated_at' => isset($taskData['updatedAt']) ? date('Y-m-d H:i:s', strtotime($taskData['updatedAt'])) : now(),
          ]);

          $this->info("Migrated task: {$taskData['title']}");
        }
      }

      DB::commit();
      $this->info("Migration completed successfully!");

    } catch (\Exception $e) {
      DB::rollBack();
      $this->error("Migration failed: " . $e->getMessage());
      return 1;
    }

    return 0;
  }
}
