@extends('admin.layouts.app')
@section('title', __('messages.message_details'))
@section('page_title', __('messages.message_details'))

@section('content')
    <div class="space-y-6">
        <a href="{{ route('admin.contact-messages.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium">
            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}"></i>
            {{ __('messages.back_to_messages') }}
        </a>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r  px-6 py-5 text-black">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold mb-1">{{ $message->subject }}</h3>
                        <p class="text-black text-sm">
                            <i class="fas fa-calendar-alt ml-1 "></i>
                            {{ $message->created_at->format('Y-m-d h:i A') }}
                        </p>
                    </div>
                    @if($message->is_read)
                        <span class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-xs font-semibold">
                        <i class="fas fa-check-circle"></i> {{ __('messages.status_read') }}
                    </span>
                    @else
                        <span class="px-3 py-1 bg-orange-500 rounded-full text-xs font-semibold">
                        <i class="fas fa-clock"></i> {{ __('messages.status_unread') }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 pb-6 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-user text-blue-500"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">{{ __('messages.sender_name') }}</p>
                            <p class="font-semibold text-gray-800">{{ $message->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">
                            <i class="fas fa-phone text-green-500"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">{{ __('messages.sender_phone') }}</p>
                            <p class="font-semibold text-gray-800" dir="ltr">{{ $message->phone }}</p>
                        </div>
                    </div>
                    @if($message->email)
                        <div class="flex items-center gap-3 md:col-span-2">
                            <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center">
                                <i class="fas fa-envelope text-purple-500"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">{{ __('messages.sender_email') }}</p>
                                <p class="font-semibold text-gray-800" dir="ltr">{{ $message->email }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <i class="fas fa-comment-dots text-blue-500"></i> {{ __('messages.message_content') }}
                    </h4>
                    <div class="bg-gray-50 rounded-lg p-5 text-gray-700 leading-relaxed whitespace-pre-wrap">
                        {{ $message->message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
