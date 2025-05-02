$table->string('reps');<?php

                        use Illuminate\Database\Migrations\Migration;
                        use Illuminate\Database\Schema\Blueprint;
                        use Illuminate\Support\Facades\Schema;

                        return new class extends Migration
                        {
                            /**
                             * Run the migrations.
                             */
                            public function up(): void
                            {
                                Schema::create('calendars', function (Blueprint $table) {
                                    $table->id();
                                    $table->string('comment');
                                    $table->string('start_date');
                                    $table->string('end_date');
                                    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                                    $table->timestamps();
                                });
                            }

                            /**
                             * Reverse the migrations.
                             */
                            public function down(): void
                            {
                                Schema::dropIfExists('calendars');
                            }
                        };
