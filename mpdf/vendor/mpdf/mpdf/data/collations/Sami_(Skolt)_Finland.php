/*
 * Copyright 2009 the original author or authors.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

package org.gradle.launcher.daemon.server;

import org.gradle.launcher.daemon.protocol.OutputMessage;
import org.gradle.internal.remote.internal.MessageIOException;
import org.gradle.internal.remote.internal.RemoteConnection;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

/**
 * Connection decorator that synchronizes dispatching.
 *
 * The plan is to replace this with a Connection implementation that queues outgoing messages and dispatches them from a worker thread.
 */
public class SynchronizedDispatchConnection<T> implements RemoteConnection<T> {
    private static final Logger LOGGER = LoggerFactory.getLogger(Synchro