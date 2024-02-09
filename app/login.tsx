import React, { useEffect, useState } from "react";
import PocketBase, { RecordModel } from "pocketbase";
import client from '@/pb.config.js';

const pb = new PocketBase(client);

