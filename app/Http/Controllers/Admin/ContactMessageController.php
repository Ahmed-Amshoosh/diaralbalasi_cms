<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\ContactSection;
use Illuminate\Http\Request;

class ContactMessageController extends Controller {
    public function index(Request $request) {
        if (!auth()->user()->can('view content')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $section = ContactSection::first();
        $filter = $request->get('filter', 'all');
        $query = ContactMessage::orderBy('created_at', 'desc');

        if ($filter === 'unread') $query->unread();
        elseif ($filter === 'read') $query->read();

        $messages = $query->paginate(15);
        $unreadCount = ContactMessage::unreadCount();

        return view('admin.contact-messages.index', compact('messages','section', 'filter', 'unreadCount'));
    }

    public function show(ContactMessage $message) {
        if (!auth()->user()->can('view messages')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        return view('admin.contact-messages.show', compact('message'));
    }


    public function destroy(ContactMessage $message) {
        if (!auth()->user()->can('delete messages')) {
            return back()->with('error', __('messages.unauthorized_action'));
        }
        $message->delete();
        return back()->with('success', __('messages.message_deleted'));
    }

    public function markAsRead(ContactMessage $message) {
        $message->update(['is_read' => true]);
        return back()->with('success', __('messages.message_marked_as_read'));
    }
}
