@extends('layout.app')

@section('title', 'My Tasks - My Todo App')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="glass rounded-2xl p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white mb-2">My Tasks</h1>
                <p class="text-white/70">Organize your day, one task at a time</p>
            </div>
            <button onclick="openAddTaskModal()"
                class="mt-4 sm:mt-0 btn-primary text-white font-semibold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                + Add Task
            </button>
        </div>
    </div>

    <!-- Date Selector -->
    <div class="glass rounded-2xl p-6">
        <div class="flex items-center space-x-4">
            <label for="task-date" class="text-white font-medium">Select Date:</label>
            <input type="date" id="task-date" value="{{ date('Y-m-d') }}" onchange="loadTasks()"
                class="px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent">
        </div>
    </div>

    <!-- Tasks Container -->
    <div id="tasks-container" class="space-y-4">
        <!-- Tasks will be loaded here dynamically -->
    </div>

    <!-- Empty State -->
    <div id="empty-state" class="hidden glass rounded-2xl p-12 text-center">
        <div class="w-24 h-24 mx-auto mb-6 bg-white/10 rounded-full flex items-center justify-center">
            <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-white mb-2">No tasks yet</h3>
        <p class="text-white/70 mb-6">Start by creating your first task for today</p>
        <button onclick="openAddTaskModal()"
            class="btn-primary text-white font-semibold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Create Task
        </button>
    </div>
</div>

<!-- Add/Edit Task Modal -->
<div id="task-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="glass rounded-2xl p-8 w-full max-w-md">
            <div class="flex justify-between items-center mb-6">
                <h3 id="modal-title" class="text-xl font-bold text-white">Add New Task</h3>
                <button onclick="closeModal()" class="text-white/70 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form id="task-form" class="space-y-6">
                <input type="hidden" id="task-id" name="task_id">

                <div>
                    <label for="title" class="block text-sm font-medium text-white/90 mb-2">Task Title</label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent"
                        placeholder="What needs to be done?">
                </div>

                <div>
                    <label for="note" class="block text-sm font-medium text-white/90 mb-2">Notes (Optional)</label>
                    <textarea id="note" name="note" rows="3"
                        class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent resize-none"
                        placeholder="Add any additional notes..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="date" class="block text-sm font-medium text-white/90 mb-2">Date</label>
                        <input type="date" id="date" name="date" required
                            class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent">
                    </div>

                    <div>
                        <label for="time" class="block text-sm font-medium text-white/90 mb-2">Time</label>
                        <input type="time" id="time" name="time" required
                            class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/90 mb-3">Color</label>
                    <div class="flex space-x-3">
                        <button type="button" onclick="selectColor(0)"
                            class="color-option w-8 h-8 rounded-full bg-purple-500 border-2 border-transparent hover:border-white/50 transition-colors"
                            data-color="0"></button>
                        <button type="button" onclick="selectColor(1)"
                            class="color-option w-8 h-8 rounded-full bg-green-500 border-2 border-transparent hover:border-white/50 transition-colors"
                            data-color="1"></button>
                        <button type="button" onclick="selectColor(2)"
                            class="color-option w-8 h-8 rounded-full bg-orange-500 border-2 border-transparent hover:border-white/50 transition-colors"
                            data-color="2"></button>
                        <button type="button" onclick="selectColor(3)"
                            class="color-option w-8 h-8 rounded-full bg-red-500 border-2 border-transparent hover:border-white/50 transition-colors"
                            data-color="3"></button>
                        <button type="button" onclick="selectColor(4)"
                            class="color-option w-8 h-8 rounded-full bg-teal-500 border-2 border-transparent hover:border-white/50 transition-colors"
                            data-color="4"></button>
                        <button type="button" onclick="selectColor(5)"
                            class="color-option w-8 h-8 rounded-full bg-pink-500 border-2 border-transparent hover:border-white/50 transition-colors"
                            data-color="5"></button>
                    </div>
                    <input type="hidden" id="colorindex" name="colorindex" value="0">
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="closeModal()"
                        class="flex-1 px-4 py-3 rounded-lg bg-white/10 text-white font-semibold hover:bg-white/20 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 btn-primary text-white font-semibold py-3 px-4 rounded-lg">
                        Save Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentTaskId = null;
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Color mapping
const colorClasses = {
    0: 'bg-purple-500',
    1: 'bg-green-500',
    2: 'bg-orange-500',
    3: 'bg-red-500',
    4: 'bg-teal-500',
    5: 'bg-pink-500'
};

// Show notification function
function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Load tasks when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadTasks();
    // Set default date and time for new tasks
    document.getElementById('date').value = document.getElementById('task-date').value;
    document.getElementById('time').value = '09:00';
});

// Load tasks for selected date
async function loadTasks() {
    const date = document.getElementById('task-date').value;
    const container = document.getElementById('tasks-container');
    const emptyState = document.getElementById('empty-state');

    try {
        const response = await fetch(`/tasks?date=${date}&ajax=1`, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });

        if (response.ok) {
            const data = await response.json();
            displayTasks(data.tasks);
        } else if (response.status === 401) {
            // Redirect to login if unauthorized
            window.location.href = '/login';
        } else {
            console.error('Failed to load tasks');
            showNotification('Failed to load tasks', 'error');
        }
    } catch (error) {
        console.error('Error loading tasks:', error);
        showNotification('Error loading tasks', 'error');
    }
}

// Display tasks
function displayTasks(tasks) {
    const container = document.getElementById('tasks-container');
    const emptyState = document.getElementById('empty-state');

    if (tasks.length === 0) {
        container.innerHTML = '';
        emptyState.classList.remove('hidden');
        return;
    }

    emptyState.classList.add('hidden');

    container.innerHTML = tasks.map(task => `
        <div class="task-card glass rounded-xl p-6">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-4 flex-1">
                    <div class="w-4 h-4 rounded-full ${colorClasses[task.colorindex] || colorClasses[0]} flex-shrink-0 mt-1"></div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white mb-1">${task.title}</h3>
                        ${task.note ? `<p class="text-white/70 mb-2">${task.note}</p>` : ''}
                        <div class="flex items-center space-x-4 text-sm text-white/60">
                            <span>📅 ${formatDate(task.date)}</span>
                            <span>🕒 ${formatTime(task.time)}</span>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-2 ml-4">
                    <button
                        onclick="editTask(${task.id})"
                        class="p-2 rounded-lg bg-white/10 text-white/70 hover:text-white hover:bg-white/20 transition-colors"
                        title="Edit task"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button
                        onclick="deleteTask(${task.id})"
                        class="p-2 rounded-lg bg-white/10 text-red-400 hover:text-red-300 hover:bg-red-500/20 transition-colors"
                        title="Delete task"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

// Open add task modal
function openAddTaskModal() {
    currentTaskId = null;
    document.getElementById('modal-title').textContent = 'Add New Task';
    document.getElementById('task-form').reset();
    document.getElementById('date').value = document.getElementById('task-date').value;
    document.getElementById('time').value = '09:00';
    document.getElementById('colorindex').value = '0';
    selectColor(0);
    document.getElementById('task-modal').classList.remove('hidden');
}

// Edit task
async function editTask(taskId) {
    try {
        // Fetch task details first
        const response = await fetch(`/tasks/${taskId}?ajax=1`, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });

        if (response.ok) {
            const data = await response.json();
            const task = data.task;

            currentTaskId = taskId;
            document.getElementById('modal-title').textContent = 'Edit Task';

            // Populate form with task data
            document.getElementById('title').value = task.title;
            document.getElementById('note').value = task.note || '';
            document.getElementById('date').value = task.date;

            // Convert time to 24-hour format for the time input (web format)
            const timeFor24HourInput = is12HourFormat(task.time) ? convertTo24Hour(task.time) : task.time;
            document.getElementById('time').value = timeFor24HourInput;

            document.getElementById('colorindex').value = task.colorindex;

            selectColor(task.colorindex);
            document.getElementById('task-modal').classList.remove('hidden');
        } else if (response.status === 401) {
            window.location.href = '/login';
        } else {
            showNotification('Failed to load task details', 'error');
        }
    } catch (error) {
        console.error('Error loading task:', error);
        showNotification('Error loading task details', 'error');
    }
}

// Close modal
function closeModal() {
    document.getElementById('task-modal').classList.add('hidden');
    currentTaskId = null;
}

// Select color
function selectColor(colorIndex) {
    document.querySelectorAll('.color-option').forEach(btn => {
        btn.classList.remove('border-white');
        btn.classList.add('border-transparent');
    });

    document.querySelector(`[data-color="${colorIndex}"]`).classList.remove('border-transparent');
    document.querySelector(`[data-color="${colorIndex}"]`).classList.add('border-white');
    document.getElementById('colorindex').value = colorIndex;
}

// Submit form
document.getElementById('task-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());

    // Ensure time is in 24-hour format for storage
    if (data.time && is12HourFormat(data.time)) {
        data.time = convertTo24Hour(data.time);
    }

    try {
        const url = currentTaskId ? `/tasks/${currentTaskId}` : '/tasks';
        const method = currentTaskId ? 'PUT' : 'POST';

        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin',
            body: JSON.stringify(data)
        });

        if (response.ok) {
            closeModal();
            loadTasks();
            showNotification(currentTaskId ? 'Task updated successfully!' : 'Task created successfully!', 'success');
        } else if (response.status === 401) {
            window.location.href = '/login';
        } else {
            const error = await response.json();
            showNotification(error.message || 'Failed to save task', 'error');
        }
    } catch (error) {
        console.error('Error saving task:', error);
        showNotification('Error saving task', 'error');
    }
});

// Delete task
async function deleteTask(taskId) {
    if (!confirm('Are you sure you want to delete this task?')) {
        return;
    }

    try {
        const response = await fetch(`/tasks/${taskId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });

        if (response.ok) {
            loadTasks();
            showNotification('Task deleted successfully!', 'success');
        } else if (response.status === 401) {
            window.location.href = '/login';
        } else {
            const error = await response.json();
            showNotification(error.message || 'Failed to delete task', 'error');
        }
    } catch (error) {
        console.error('Error deleting task:', error);
        showNotification('Error deleting task', 'error');
    }
}

// Helper functions
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        weekday: 'short',
        month: 'short',
        day: 'numeric'
    });
}

function formatTime(timeString) {
    // If it's already in 12-hour format (contains AM/PM), return as is
    if (timeString.includes('AM') || timeString.includes('PM')) {
        return timeString;
    }

    // Handle 24-hour format (HH:MM or HH:MM:SS)
    const timeParts = timeString.split(':');
    const hours = parseInt(timeParts[0]);
    const minutes = parseInt(timeParts[1]);

    // Create a date object to format the time consistently
    const date = new Date();
    date.setHours(hours, minutes, 0, 0);

    return date.toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    });
}

// Convert 12-hour format (from mobile) to 24-hour format for storage/display
function convertTo24Hour(timeString) {
    // Check if it's already in 24-hour format
    if (!timeString.includes('AM') && !timeString.includes('PM')) {
        return timeString; // Already in 24-hour format
    }

    const [time, modifier] = timeString.split(' ');
    let [hours, minutes] = time.split(':');
    hours = parseInt(hours);

    if (modifier === 'PM' && hours !== 12) {
        hours += 12;
    } else if (modifier === 'AM' && hours === 12) {
        hours = 0;
    }

    return `${hours.toString().padStart(2, '0')}:${minutes}`;
}

// Convert 24-hour format to 12-hour format for display
function convertTo12Hour(time24h) {
    const [hours, minutes] = time24h.split(':');
    const date = new Date();
    date.setHours(parseInt(hours), parseInt(minutes));

    return date.toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    });
}

// Detect if time string is in 12-hour format
function is12HourFormat(timeString) {
    return timeString.includes('AM') || timeString.includes('PM');
}

// Close modal when clicking outside
document.getElementById('task-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endpush
